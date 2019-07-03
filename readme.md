# Small Shop

## Install

Before install project you need to install [Docker](https://docs.docker.com/install/) on your system.

Then run:

```bash
$ ./install
```

After process was finished - open `http://small-shop.localhost`.

## Use cases

- `docker-compose up -d` - start project
- `docker-compose stop` - stop project
- `./cmd {any command}` - execute `{any command}` inside container, like `./cmd php artisan migrate`

Start:

```bash
$ docker-compose up -d
```

## Troubleshooting

Some apps can't recognize the *.localhost domains so to fix that you probably need to append next lines at the end of `/etc/hosts` file:

```
127.0.0.1   small-shop.localhost
```
