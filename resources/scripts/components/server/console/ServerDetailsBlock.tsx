import React, { useEffect, useState } from 'react';
import { faClock, faCloudDownloadAlt, faCloudUploadAlt, faUsers } from '@fortawesome/free-solid-svg-icons';
import { bytesToString } from '@/lib/formatters';
import { ServerContext } from '@/state/server';
import { SocketEvent, SocketRequest } from '@/components/server/events';
import UptimeDuration from '@/components/server/UptimeDuration';
import StatBlock from '@/components/server/console/StatBlock';
import useWebsocketEvent from '@/plugins/useWebsocketEvent';
import classNames from 'classnames';
import { capitalize } from '@/lib/strings';
import getServerResourceUsage from '@/api/server/getServerResourceUsage';

type Stats = Record<'memory' | 'cpu' | 'disk' | 'uptime' | 'rx' | 'tx', number>;

const getBackgroundColor = (value: number, max: number | null): string | undefined => {
    const delta = !max ? 0 : value / max;

    if (delta > 0.8) {
        if (delta > 0.9) {
            return 'bg-red-500';
        }
        return 'bg-yellow-500';
    }

    return undefined;
};

const ServerDetailsBlock = ({ className }: { className?: string }) => {
    const [stats, setStats] = useState<Stats>({ memory: 0, cpu: 0, disk: 0, uptime: 0, tx: 0, rx: 0 });
    const [players, setPlayers] = useState<{ online: number | null; max: number | null }>({ online: null, max: null });

    const status = ServerContext.useStoreState((state) => state.status.value);
    const connected = ServerContext.useStoreState((state) => state.socket.connected);
    const instance = ServerContext.useStoreState((state) => state.socket.instance);
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);

    useEffect(() => {
        if (!connected || !instance) {
            return;
        }

        instance.send(SocketRequest.SEND_STATS);
    }, [instance, connected]);

    useWebsocketEvent(SocketEvent.STATS, (data) => {
        let stats: any = {};
        try {
            stats = JSON.parse(data);
        } catch (e) {
            return;
        }

        setStats({
            memory: stats.memory_bytes,
            cpu: stats.cpu_absolute,
            disk: stats.disk_bytes,
            tx: stats.network.tx_bytes,
            rx: stats.network.rx_bytes,
            uptime: stats.uptime || 0,
        });
    });

    // Poll players from the REST resources endpoint since websocket does not include it
    useEffect(() => {
        let timer: ReturnType<typeof setInterval> | null = null;
        const fetchPlayers = () =>
            getServerResourceUsage(uuid)
                .then((data) => setPlayers({ online: data.playersOnline, max: data.playersMax }))
                .catch(() => setPlayers({ online: null, max: null }));

        fetchPlayers();
        timer = setInterval(fetchPlayers, 30000);

        return () => {
            if (timer) clearInterval(timer);
        };
    }, [uuid]);

    return (
        <div className={classNames('grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4', className)}>
            <StatBlock
                icon={faClock}
                title={'Uptime'}
                color={getBackgroundColor(status === 'running' ? 0 : status !== 'offline' ? 9 : 10, 10)}
            >
                {status === null ? (
                    'Offline'
                ) : stats.uptime > 0 ? (
                    <UptimeDuration uptime={stats.uptime / 1000} />
                ) : (
                    capitalize(status)
                )}
            </StatBlock>
            <StatBlock icon={faUsers} title={'Players'}>
                {status === 'offline' || players.online === null || players.max === null ? (
                    <span className={'text-gray-400'}>Unknown</span>
                ) : (
                    <>{players.online} / {players.max}</>
                )}
            </StatBlock>
            <StatBlock icon={faCloudDownloadAlt} title={'Network (Inbound)'}>
                {status === 'offline' ? <span className={'text-gray-400'}>Offline</span> : bytesToString(stats.rx)}
            </StatBlock>
            <StatBlock icon={faCloudUploadAlt} title={'Network (Outbound)'}>
                {status === 'offline' ? <span className={'text-gray-400'}>Offline</span> : bytesToString(stats.tx)}
            </StatBlock>
        </div>
    );
};

export default ServerDetailsBlock;
