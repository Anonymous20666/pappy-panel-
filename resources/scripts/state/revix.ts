import { action, Action } from 'easy-peasy';

export interface RevixSettings {
    logo: string;
    customCopyright: boolean;
    copyright: string;
    isUnderMaintenance: boolean;
    maintenance: string;
    themeSelector: boolean;
    allocationBlur: boolean;
    alertType: string;
    alertMessage: string;
}

export interface RevixSettingsStore {
    data?: RevixSettings;
    setRevix: Action<RevixSettingsStore, RevixSettings>;
}

const revix: RevixSettingsStore = {
    data: undefined,

    setRevix: action((state, payload) => {
        state.data = payload;
    }),
};

export default revix;
