import { Component, OnInit, OnDestroy } from '@angular/core';
import { Subscription } from 'rxjs';
import { Product } from 'src/app/models/product.model'
import { CartService } from 'src/app/services/cart.service';
import { StoreService } from 'src/app/services/store.service';

const ROWS_HEIGHT: { [id: number]: number} = {1: 400, 3: 335, 4: 350};

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
})
export class HomeComponent implements OnInit, OnDestroy {

  columns: number = 3;
  rowHeight: number = ROWS_HEIGHT[this.columns];
  category: string | undefined;

  products: Array<Product> | undefined;
  sort: string = 'asc';
  count: string = '12';
  productsSubscription: Subscription | undefined;

  constructor(private cartService: CartService, private storeService: StoreService) { }

  ngOnInit() {
    this.getProducts();
  }

  onColumnsCountChanged(columnsNumber: number): void {
    this.columns = columnsNumber;
    this.rowHeight = ROWS_HEIGHT[this.columns];
  }

  onItemsCountChanged(newCount: number): void {
    this.count = newCount.toString();
    this.getProducts();
  }

  onSortChanged(newSort: string): void {
    this.sort = newSort;
    this.getProducts();
  }

  onShowCategory(newCategory: string): void {
    if (newCategory) {
      this.category = newCategory;
      this.getProducts();
    } else {
      this.category = undefined;
      this.getProducts();
    }
  }

  onAddToCart(product: Product): void {
    this.cartService.addToCart({
      product: "../../../../placeholder.png",
      name: product.name,
      price: product.price,
      quantity: 1,
      id: product.id
    });
  }

  getProducts(): void {
    this.productsSubscription = this.storeService.getAllProducts(this.count, this.sort, this.category)
      .subscribe((_products) => this.products = _products);
  }

  ngOnDestroy() {
    if (this.productsSubscription) {
      this.productsSubscription.unsubscribe();
    }
  }
}
