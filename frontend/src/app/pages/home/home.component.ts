import { Component } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
})
export class HomeComponent {

  columns: number = 3;

  onColumnsCountChanged(columnsNumber: number): void {
    this.columns = columnsNumber;
  }
}
