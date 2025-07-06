import { createStore } from 'easy-peasy';
import flashes, { FlashStore } from '@/state/flashes';
import user, { UserStore } from '@/state/user';
import permissions, { GloablPermissionsStore } from '@/state/permissions';
import settings, { SettingsStore } from '@/state/settings';
import revix, { RevixSettingsStore } from '@/state/revix';
import progress, { ProgressStore } from '@/state/progress';

export interface ApplicationStore {
    permissions: GloablPermissionsStore;
    flashes: FlashStore;
    user: UserStore;
    settings: SettingsStore;
    progress: ProgressStore;
    revix: RevixSettingsStore;
}

const state: ApplicationStore = {
    permissions,
    flashes,
    user,
    settings,
    progress,
    revix,
};

export const store = createStore(state);
