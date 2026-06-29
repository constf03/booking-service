New-Item -ItemType Directory -Force -Path "$PSScriptRoot\db" | Out-Null
Set-Content -Path "$PSScriptRoot\db\password.txt" -Value "supersecretpassword123" -Encoding utf8
