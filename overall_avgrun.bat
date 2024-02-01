@echo off
set PHP_PATH=C:\xampp\php\php.exe
set SCRIPT_PATH1=C:\xampp\htdocs\crop\overall_daily.php

:start
%PHP_PATH% %SCRIPT_PATH1%

timeout /t 1 /nobreak  >nul
goto start
