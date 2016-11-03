@echo off

if %1.==Sub. goto %2

for %%f in (*.php) do call %0 Sub action %%~nf
goto end

:action
	php %3.php > %3.html
	echo Outputted to %3.html
:end