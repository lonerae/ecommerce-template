import { Component, Input } from '@angular/core';
import { Cart, CartItem } from 'src/app/models/cart.model';
import { Category } from 'src/app/models/category.model';
import { MenuCategory } from 'src/app/models/menu-category.model';
import { CartService } from 'src/app/services/cart.service';
import { UiService } from 'src/app/services/ui.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
})
export class HeaderComponent {

  private _cart: Cart = { items: []};
  itemsQuantity: number = 0;
  categories: MenuCategory[] = [
    {id:1, name:'Category 1', subCategories:['Sub 1', 'Sub 2', 'Sub 3']},
    {id:2, name:'Category 2', subCategories:['Sub 1','Sub 2']}
  ];
  dropDowns: number[] = Array<number>(this.categories.length).fill(0);
  visibleBtn: boolean[] = Array<boolean>(this.categories.length).fill(false);
  visibleLi: boolean[] = Array<boolean>(this.categories.length).fill(false);

  constructor(private cartService: CartService, private uiService: UiService) { }

  @Input()
  get cart(): Cart {
    return this._cart;
  }

  set cart(cart: Cart) {
    this._cart = cart;

    this.itemsQuantity = cart.items
      .map((item) => item.quantity)
      .reduce((prev,current) => prev+current,0);   
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

  toggleDropdown(index: number, value: number): void {
    if (value === 0) {
      setTimeout(() => {
        if (!this.visibleBtn[index] && !this.visibleLi[index]) {
          this.dropDowns[index] = value;
        }
      }, 50);
    } else {
      this.dropDowns[index] = value;
    }
  }
}
