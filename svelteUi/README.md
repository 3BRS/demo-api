# Development

```sh
if [ "$(pwd | grep --only-matching -E '/adminUi$')" != "/adminUi" ]; then cd adminUi; fi
cp .env.dist .env
yarn install
yarn run dev
```

Run these commands before each push, If it fails, **CI forbids merge**!

```sh
yarn run check
yarn run lint
```
