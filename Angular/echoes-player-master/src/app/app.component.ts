import { Store } from '@ngrx/store';
import { VersionCheckerService } from './core/services/version-checker.service';
import { Component, HostBinding, OnInit } from '@angular/core';
import { EchoesState } from '@store/reducers';
import { getSidebarCollapsed, getAppTheme } from '@store/app-layout';


@Component({
  selector: 'body',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  sidebarCollapsed$ = this.store.select(getSidebarCollapsed);
  theme$ = this.store.select(getAppTheme);

  @HostBinding('class')
  style = 'arctic';

  constructor(private store: Store<EchoesState>, private versionCheckerService: VersionCheckerService) {
    versionCheckerService.start();
  }

  ngOnInit() {
    this.theme$.subscribe(theme => this.style = theme);
  }
}
