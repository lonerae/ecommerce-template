import { Injectable } from '@angular/core';
import { Product } from '../models/product.model';

@Injectable({
  providedIn: 'root'
})
export class UiService {

  constructor() { }

  getUiPrice(price: number): number {
    return price / 100;
  }
}
