import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { loadStripe } from '@stripe/stripe-js';
import { Cart, CartItem } from 'src/app/models/cart.model'
import { CartService } from 'src/app/services/cart.service';
import { UiService } from 'src/app/services/ui.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html'
})
export class CartComponent implements OnInit {

  cart: Cart = { items: []};
  dataSource: Array<CartItem> = [];
  displayedColumns: Array<String> = [
    'product',
    'name',
    'price',
    'quantity',
    'total',
    'action'
  ];

  constructor(private cartService: CartService, private uiService: UiService, private http: HttpClient) { }

  ngOnInit() {
    this.cartService.cart.subscribe((_cart: Cart) => {
      this.cart = _cart;
      this.dataSource = this.cart.items;
    })
  }

  getPartialTotal(item: CartItem): number {
    return item.price * item.quantity;
  }

  getTotal(items: Array<CartItem>): number {
    return this.cartService.getTotal(items);
  }

  getUiPrice(price: number): number {
    return this.uiService.getUiPrice(price);
  }

  onClearCart(): void {
    this.cartService.clearCart();
  }

  onRemoveFromCart(element: CartItem): void {
    this.cartService.removeFromCart(element);
  }

  onAddItem(element: CartItem): void {
    this.cartService.addItem(element);
  }

  onRemoveItem(element: CartItem): void {
    this.cartService.removeItem(element);
  }

  onCheckout(): void {
    this.http.post('http://localhost:4242/checkout', {
      items: this.cart.items
    }).subscribe(async (res: any) => {
      let stripe = await loadStripe('pk_test_51MU72KBjLlMlcBNc2kiwMOjJSSNR0SRjBZQVkxfQBA9bVy7iY6K4VC6AZIF2Fxdxjk3sLWoXiRgfT6faSWnBuIX40014VyM9Me');
      stripe?.redirectToCheckout({
        sessionId: res.id
      })
  });
  }
}
