import { Store } from '@ngrx/store';
import { Observable } from 'rxjs/Observable';
import { IPlayerSearch, IQueryParam } from './player-search.reducer';
import { EchoesState } from '@store/reducers';
import { createSelector } from '@ngrx/store/src/selector';

export const getPlayerSearch = (state: EchoesState) => state.search;
export const getPlayerSearchResults = createSelector(getPlayerSearch, (search: IPlayerSearch) => search.results);
export const getQuery = createSelector(getPlayerSearch, (search: IPlayerSearch) => search.query);
export const getQueryParams = createSelector(getPlayerSearch, (search: IPlayerSearch) => search.queryParams);
export const getQueryParamPreset = createSelector(getPlayerSearch, getQueryParams,
  (search: IPlayerSearch, queryParams: IQueryParam) => queryParams.preset);
export const getSearchType = createSelector(getPlayerSearch, (search: IPlayerSearch) => search.searchType);
export const getIsSearching = createSelector(getPlayerSearch, (search: IPlayerSearch) => search.isSearching);
export const getPresets = createSelector(getPlayerSearch, (search: IPlayerSearch) => search.presets);
