# StartNB . API

# 1.注册

### 请求地址
> http://start.7ve.cn/register

### 请求参数
|参数|必填|类型|说明|
|:-----   |:-------|:-----  |-----  |
|name     |ture    |sting   |用户名|
|pass     |ture    |sting   |密码|

### 返回结果
``` javascript
{
    "code": 0, //0为成功，其它为失败
    "msg":'注册成功'  //提示信息
}
```


# 2.登录

### 请求地址
> http://start.7ve.cn/login

### 请求参数
|参数|必填|类型|说明|
|:-----  |:-------|:-----|-----  |
|name     |ture    |sting   |用户名|
|pass     |ture    |sting   |密码|

### 返回结果
``` javascript
{
      "code": 0,
      "msg":"登录成功",
      "token": "adfjdskajfdisidfff",
}
```

