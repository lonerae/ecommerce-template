import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-products-header',
  templateUrl: './products-header.component.html',
})
export class ProductsHeaderComponent {
  @Output() columnsCountChange = new EventEmitter<number>;
  sort: string = 'desc';
  itemsShowCount: number = 12;

  onSortUpdated(newSort: string): void {
    this.sort = newSort;
  }

  onItemsCountUpdated(newItemsCount: number): void {
    this.itemsShowCount = newItemsCount;
  }

  onColumnsUpdated(columnsNumber: number): void {
    this.columnsCountChange.emit(columnsNumber);
  }
}
