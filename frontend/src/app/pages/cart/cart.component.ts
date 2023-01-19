import { Component } from '@angular/core';
import { Cart, CartItem } from 'src/app/models/cart.model'
import { CartService } from 'src/app/services/cart-service.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html'
})
export class CartComponent {

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

  constructor(private cartService: CartService) { }

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
}
