import { Category } from "./category.model";

export interface Product {
    id: number;
    name: string;
    weight: string;
    price: number;
    vat: string;
    categorySet: Set<Category>;
    description: string;
    // image: string;
}