- `ng serve -o` in `frontend` to load the UI
- `node server.js` in `frontend/server` to activate stripe checkout

> Don't forget to 
> - change the public key with your own in `cart.component.ts`
> - add an `.env` file in `frontend/` with a `SECRET_KEY={your_stripe_secret_key}` environment variable, to enable the stripe authorization
