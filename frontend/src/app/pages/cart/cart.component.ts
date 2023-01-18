import { Component } from '@angular/core';
import { Cart, CartItem } from 'src/app/models/cart.model'

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html'
})
export class CartComponent {

  cart: Cart = {items: [{
    product: 'https://via.placeholder.com/150',
    name: 'Pi Case',
    price: 5,
    quantity: 2,
    id: 1
  },
  {
    product: 'https://via.placeholder.com/150',
    name: 'Laptop Case',
    price: 12,
    quantity: 1,
    id: 2
  }]};
  dataSource: Array<CartItem> = [];
  displayedColumns: Array<String> = [
    'product',
    'name',
    'price',
    'quantity',
    'total',
    'action'
  ];

  ngOnInit() {
    this.dataSource = this.cart.items;
  }

  getPartialTotal(item: CartItem): number {
    return item.price * item.quantity;
  }

  getTotal(items: Array<CartItem>): number {
    return items
      .map((item) => item.price * item.quantity)
      .reduce((prev,cur) => prev + cur, 0);
  }

}
