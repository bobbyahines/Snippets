# Effective Crontabs

```bash
# m h  dom mon dow   command
15 01 * * * /bin/sh /home/user/prod-stack/devops/backups.sh 1>> /dev/null 2>&1
00 05 * * * /bin/sh /home/user/prod-stack/devops/cleanups.sh 1>> /dev/null 2>&1
```
