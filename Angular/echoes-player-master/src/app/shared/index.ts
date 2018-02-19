import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';

import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { NgxTypeaheadModule } from 'ngx-typeahead';
import { YoutubePlayerModule } from 'ngx-youtube-player';
import { CORE_COMPONENTS } from './components';
import { CORE_DIRECTIVES } from './directives';
import { PIPES } from './pipes';
import { TooltipModule } from 'ngx-tooltip';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule,
    YoutubePlayerModule,
    InfiniteScrollModule,
    NgxTypeaheadModule,
    TooltipModule
  ],
  declarations: [
    ...CORE_COMPONENTS,
    ...CORE_DIRECTIVES,
    ...PIPES
  ],
  exports: [
    CommonModule,
    FormsModule,
    ...CORE_COMPONENTS,
    ...CORE_DIRECTIVES,
    ...PIPES,
    InfiniteScrollModule,
    YoutubePlayerModule,
    NgxTypeaheadModule,
    TooltipModule
  ],
  providers: []
})
export class SharedModule { }
