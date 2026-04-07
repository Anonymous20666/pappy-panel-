import { action, Action } from 'easy-peasy';

export interface MerlinHostAlert {
    type: string;
    message: string;
}

export interface MerlinHostSidebarButton {
    label: string;
    url: string;
    newTab: boolean;
}

export interface MerlinHostSettings {
    customCopyright: boolean;
    copyright: string;
    isUnderMaintenance: boolean;
    maintenance: string;
    themeSelector: boolean;
    sidebarLogout: boolean;
    allocationBlur: boolean;
    alertType: string;
    alertMessage: string;
    alerts?: MerlinHostAlert[];
    sidebarButtons?: MerlinHostSidebarButton[];
    statusCardLink: string;
    supportCardLink: string;
    billingCardLink: string;
    alwaysShowKillButton: boolean;
}

export interface MerlinHostSettingsStore {
    data?: MerlinHostSettings;
    setMerlinHost: Action<MerlinHostSettingsStore, MerlinHostSettings>;
}

const merlinhost: MerlinHostSettingsStore = {
    data: undefined,

    setMerlinHost: action((state, payload) => {
        state.data = payload;
    }),
};

export default merlinhost;
