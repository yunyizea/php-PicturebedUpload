# 一~个~简~易~的~图~床~上~传~系~统

##  食用方法
```
# git clone文件到本地，将php文件上传到图床对应的文件夹
# 本地编译或者下载编译好的python脚本
```

## API
| StatusCode | Schematic |
| -: | :- |
| 200 | 正常上传，并且会返回文件URL |
| -1 | 文件格式未知，或者文件格式不被允许，上传失败 |
| -2 | 其他常见错误，phpApi会返回对应错误消息 |
| -3 | 文件已存在于文件夹中，不上传，返回对应文件URL |
| -114514 | 未知的奇奇怪怪错误 |