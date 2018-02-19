import { Store } from '@ngrx/store';
import { IUserProfile } from './user-profile.reducer';
import { EchoesState } from '@store/reducers';
import { createSelector } from '@ngrx/store/src/selector';

export const getUser = (state: EchoesState) => state.user;
export const getUserPlaylists = createSelector(getUser, (user: IUserProfile) => user.playlists);
export const getUserViewPlaylist = createSelector(getUser, (user: IUserProfile) => user.viewedPlaylist);
export const getIsUserSignedIn = createSelector(getUser, (user: IUserProfile) => user.access_token !== '');
