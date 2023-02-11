import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-products-header',
  templateUrl: './products-header.component.html',
})
export class ProductsHeaderComponent {
  @Output() columnsCountChange = new EventEmitter<number>;
  @Output() itemsCountChange = new EventEmitter<number>;
  @Output() sortChange = new EventEmitter<string>;



  sort: string = 'Ascending price';
  itemsShowCount: number = 12;

  onSortUpdated(newSort: string): void {
    this.sort = newSort;
    this.sortChange.emit(newSort);
  }

  onItemsCountUpdated(newItemsCount: number): void {
    this.itemsShowCount = newItemsCount;
    this.itemsCountChange.emit(newItemsCount);
  }

  onColumnsUpdated(columnsNumber: number): void {
    this.columnsCountChange.emit(columnsNumber);
  }
}
