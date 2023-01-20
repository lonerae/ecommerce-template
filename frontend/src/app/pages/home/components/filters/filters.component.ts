import { Component, EventEmitter, OnDestroy, OnInit, Output, ViewChild } from '@angular/core';
import { MatSelectionList } from '@angular/material/list';
import { Subscription } from 'rxjs';
import { StoreService } from 'src/app/services/store.service';

@Component({
  selector: 'app-filters',
  templateUrl: './filters.component.html'
})
export class FiltersComponent implements OnInit, OnDestroy {
  @Output() showCategory = new EventEmitter<string>();
  @ViewChild(MatSelectionList) filters: MatSelectionList | undefined;

  categories: Array<string> | undefined;
  categoriesSubscription: Subscription | undefined;

  constructor(private storeService: StoreService) {}

  ngOnInit() {
    this.categoriesSubscription = this.storeService.getAllCategories()
      .subscribe((_categories) => this.categories = _categories);
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
