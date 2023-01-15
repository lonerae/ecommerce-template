import { Component } from '@angular/core';

const ROWS_HEIGHT: { [id: number]: number} = {1: 400, 3: 335, 4: 350};

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
})
export class HomeComponent {

  columns: number = 3;
  rowHeight: number = ROWS_HEIGHT[this.columns];
  category: string | undefined;

  onColumnsCountChanged(columnsNumber: number): void {
    this.columns = columnsNumber;
    this.rowHeight = ROWS_HEIGHT[this.columns];
  }

  onShowCategory(newCategory: string): void {
    this.category = newCategory;
  }
}
