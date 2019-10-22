<?php


/**
 * 测试函数 执行完退出 可以传入任意个参数,只在调试模试下执行
 */
function pre ()
{
    $args = func_get_args();
    $debugArr = debug_backtrace();
    $timeArr = explode( ' ' , microtime() );
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<pre  style='color:red'><hr><hr>【调用文件】:" , $debugArr [ 0 ] [ 'file' ] , '<br/>【调用行号】:' , $debugArr [ 0 ] [ 'line' ] , '<br/>';
    echo '【调用时间】:' , date( 'Y-m-d H:i:s ' , $timeArr[ 1 ] ) , $timeArr[ 0 ] , '<hr>';
    foreach ( $args as $k => $v ) {
        $getType = gettype( $v );
        echo '【变量序号】:' , $k + 1 , '<br/>【变量类型】:' , $getType , '<br/>';
        'boolean' == $getType ? var_dump( $v ) : print_r( $v );
        echo '<hr>';
    }
    echo '<hr></pre>';
    exit;
}

/**
 * 测试函数 执行完不退出 可以传入任意个参数,只在调试模试下执行
 */
function pr ()
{
    $args = func_get_args();
    $timeArr = explode( ' ' , microtime() );
    $debugArr = debug_backtrace();
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<pre  style='color:red'><hr><hr>【调用文件】:" , $debugArr [ 0 ] [ 'file' ] , '<br/>【调用行号】:' , $debugArr [ 0 ] [ 'line' ] , '<br/>';
    echo '【调用时间】:' , date( 'Y-m-d H:i:s ' , $timeArr[ 1 ] ) , $timeArr[ 0 ] , '<hr>';
    foreach ( $args as $k => $v ) {
        $getType = gettype( $v );
        echo '【变量序号】:' , $k + 1 , '<br/>【变量类型】:' , $getType , '<br/>';
        'boolean' == $getType ? var_dump( $v ) : print_r( $v );
        echo '<hr>';
    }
    echo '<hr></pre>';
}
