import { Component, EventEmitter, OnDestroy, OnInit, Output, ViewChild } from '@angular/core';
import { Subscription } from 'rxjs';
import { MatSelectionList } from '@angular/material/list';
import { StoreService } from 'src/app/services/store.service';

@Component({
  selector: 'app-products-header',
  templateUrl: './products-header.component.html',
})
export class ProductsHeaderComponent implements OnInit, OnDestroy {
  @Output() columnsCountChange = new EventEmitter<number>;
  @Output() itemsCountChange = new EventEmitter<number>;
  @Output() sortChange = new EventEmitter<string>;
  @Output() showCategory = new EventEmitter<string>();
  @ViewChild(MatSelectionList) filters: MatSelectionList | undefined;

  categories: Array<string> | undefined;
  categoriesSubscription: Subscription | undefined;
  sort: string = 'Ascending price';
  itemsShowCount: number = 12;

  constructor(private storeService: StoreService) {}

  ngOnInit() {
    this.categoriesSubscription = this.storeService.getAllCategories()
      .subscribe((_categories) => this.categories = _categories);
  }

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

  onShowCategory(category: string): void {
    this.showCategory.emit(category);
  }

  clearFilters(): void {
    this.showCategory.emit("");
    this.filters?.deselectAll();
  }

  ngOnDestroy(): void {
    if (this.categoriesSubscription) {
      this.categoriesSubscription.unsubscribe();
    }
  } 
}
