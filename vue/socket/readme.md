两种方式
1.全局导入
main.js

2.需要的页面导入
import Socket from 'websocketUtil.js';

使用声明


```javascript
export default {
	data() {
		return {
			socket:null,
			}
		}
	},
	onLoad(params) {
		
		this.socket = new Socket('ws://127.0.0.1:7272');
		this.socket.on('open', event => {
			console.log("Connected to server", event);
		});
		this.socket.on('message', data => {
			this.onMessage(data)
		});
		this.socket.on('error', error => {
			console.error("WebSocket Error:", error);
		});
		this.socket.on('close', event => {
			console.log("Connection closed", event);
		});
	},
```

