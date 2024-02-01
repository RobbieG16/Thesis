@echo off
set PHP_PATH=C:\xampp\php\php.exe
set SCRIPT_PATH1=C:\xampp\htdocs\crop\averagedaily1.php
set SCRIPT_PATH2=C:\xampp\htdocs\crop\averagedaily2.php
set SCRIPT_PATH3=C:\xampp\htdocs\crop\averagedaily3.php

:start
%PHP_PATH% %SCRIPT_PATH1%
%PHP_PATH% %SCRIPT_PATH2%
%PHP_PATH% %SCRIPT_PATH3%

timeout /t 1 /nobreak  >nul
goto start
