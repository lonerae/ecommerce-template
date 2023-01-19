import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Product } from 'src/app/models/product.model';

@Component({
  selector: 'app-product-box',
  templateUrl: './product-box.component.html'
})
export class ProductBoxComponent {
  @Input() fullWidthMode: boolean = false; 
  product: Product | undefined = {
    id: 1,
    title: 'Pi Case',
    price: 10,
    category: 'Electronics',
    description: 'Description',
    image: 'https://via.placeholder.com/150'
  };
  @Output() addToCart = new EventEmitter();

  onAddToCart(): void {
    this.addToCart.emit(this.product);
  }
}
