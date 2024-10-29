class Socket {
    constructor(url, opts = {}) {
        this.url = url;
        this.ws = null;
        this.opts = {
            heartbeatInterval: 30000, // 默认30秒
            reconnectInterval: 5000, // 默认5秒
            maxReconnectAttempts: 5, // 默认尝试重连5次
            ...opts
        };
        this.reconnectAttempts = 0;
        this.listeners = {};
 
        this.init();
    }
 
    init() {
        this.ws = new WebSocket(this.url);
 
        this.ws.onopen = this.onOpen.bind(this);
        this.ws.onmessage = this.onMessage.bind(this);
        this.ws.onerror = this.onError.bind(this);
        this.ws.onclose = this.onClose.bind(this);
    }
 
    onOpen(event) {
        console.log('WebSocket opened:', event);
        this.reconnectAttempts = 0; // 重置重连次数
        this.startHeartbeat();
        this.emit('open', event);
    }
 
    onMessage(event) {
        console.log('WebSocket message received:', event.data);
        this.emit('message', event.data);
    }
 
    onError(event) {
        console.error('WebSocket error:', event);
        this.emit('error', event);
    }
 
    onClose(event) {
        console.log('WebSocket closed:', event);
        this.stopHeartbeat();
        this.emit('close', event);
        if (this.reconnectAttempts < this.opts.maxReconnectAttempts) {
            setTimeout(() => {
                this.reconnectAttempts++;
                this.init();
            }, this.opts.reconnectInterval);
        }
    }
 
    // 发送心跳
    startHeartbeat() {
        this.heartbeatInterval = setInterval(() => {
            if (this.ws.readyState === WebSocket.OPEN) {
                this.ws.send('ping'); // 可以修改为你的心跳消息格式
            }
        }, this.opts.heartbeatInterval);
    }
 
    // 停止心跳
    stopHeartbeat() {
        if (this.heartbeatInterval) {
            clearInterval(this.heartbeatInterval);
            this.heartbeatInterval = null;
        }
    }
 
    send(data) {
        if (this.ws.readyState === WebSocket.OPEN) {
            this.ws.send(data);
        } else {
            console.error('WebSocket is not open. Cannot send:', data);
        }
    }
 
    on(event, callback) {
        if (!this.listeners[event]) {
            this.listeners[event] = [];
        }
        this.listeners[event].push(callback);
    }
 
    off(event, callback) {
        if (!this.listeners[event]) return;
        const index = this.listeners[event].indexOf(callback);
        if (index !== -1) {
            this.listeners[event].splice(index, 1);
        }
    }
 
    emit(event, data) {
        if (this.listeners[event]) {
            this.listeners[event].forEach(callback => callback(data));
        }
    }
}
 
export default Socket;