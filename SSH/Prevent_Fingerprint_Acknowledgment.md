This adds to the known_hosts to pre-flight the keys.

```bash
ssh-keyscan $someip >> ~/.ssh/known_hosts
```

Source: [https://stackoverflow.com/questions/18123554/how-to-automatically-accept-the-remote-key-when-rsyncing](https://stackoverflow.com/questions/18123554/how-to-automatically-accept-the-remote-key-when-rsyncing)
