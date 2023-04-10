import { Product } from "./product.model";

export interface Category {
    id: number;
    name: String;
    productSet?: Set<Product>;
}