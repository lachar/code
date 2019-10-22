<?php


/**
 * 检查手机格式，中国手机不带国家代码，国际手机号格式为：国家代码-手机号
 * @param $mobile
 * @return bool
 */
function check_mobile($mobile)
{
    if (preg_match('/(^(13\d|14\d|15\d|16\d|17\d|18\d|19\d)\d{8})$/', $mobile)) {
        return true;
    } else {
        if (preg_match('/^\d{1,4}-\d{5,11}$/', $mobile)) {
            if (preg_match('/^\d{1,4}-0+/', $mobile)) {
                //不能以0开头
                return false;
            }

            return true;
        }

        return false;
    }
}

/**
 * 检查 邮箱
 * @param $email
 * @return bool
 */
function check_email($email)
{
    if (preg_match('/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/', $email)) {
        return true;
    } else {
        return false;
    }
}
/**
 * 检查 qq
 * @param $qq
 * @return bool
 */
function check_qq($qq)
{
    if (preg_match('/^[1-9][0-9]{4,}$/', $qq)) {
        return true;
    } else {
        return false;
    }
}
/**
 * 检查 字母
 * @param $account
 * @return bool
 */
function check_e_num($account)
{
    if (preg_match('/^[a-zA-Z\d]{4,}$/', $account)) {
        return true;
    } else {
        return false;
    }
}
/**
 * 检查账号
 * @param $account
 * @return bool
 */
function check_account($account)
{
    if (preg_match('/^.{4,}$/', $account)) {
        return true;
    } else {
        return false;
    }
}