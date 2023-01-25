import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Product } from 'src/app/models/product.model';
import { UiService } from 'src/app/services/ui.service';

@Component({
  selector: 'app-product-box',
  templateUrl: './product-box.component.html'
})
export class ProductBoxComponent {
  @Input() fullWidthMode: boolean = false; 
  @Input() product: Product | undefined;
  @Output() addToCart = new EventEmitter();

  constructor(private uiService: UiService){}

  onAddToCart(): void {
    this.addToCart.emit(this.product);
  }

  getUiPrice(price: number): number {
    return this.uiService.getUiPrice(price);
  }
}
