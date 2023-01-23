import { Category } from "./category.model";

export interface Product {
    id: number;
    title: string;
    price: number;
    categorySet: Set<Category>;
    description: string;
    image: string;
}