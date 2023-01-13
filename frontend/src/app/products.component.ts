import { Component } from "@angular/core";
import { ProductsService } from "./products.service";

@Component({
    selector: 'products',
    template: `
        <h2>{{title}}</h2>
        <ul>
            <li *ngFor="let product of products">
                {{product}}
            </li>
        </ul>
    `
})
export class ProductsComponent {
    title = "Available Products";
    products: string[];

    constructor(productsService: ProductsService) {
        this.products = productsService.getProducts();
    }
}