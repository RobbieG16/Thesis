@echo off
:start
python predecting.py
python Hybrid_prediction.py

timeout /t 1 /nobreak  >nul
goto start