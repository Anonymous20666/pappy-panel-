import React, { useEffect, useRef, useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faMemory } from '@fortawesome/free-solid-svg-icons';
import { Link } from 'react-router-dom';
import { Server } from '@/api/server/getServer';
import getServerResourceUsage, { ServerStats } from '@/api/server/getServerResourceUsage';
import { bytesToString, ip, mbToBytes } from '@/lib/formatters';
import Spinner from '@/components/elements/Spinner';
import Card from '@/components/ui/Card';
import { ChipIcon, GlobeIcon, SaveIcon } from '@heroicons/react/solid';
import Title from '@/components/ui/Title';
import { StatBlock } from '@/components/ui/StatBlock';
import StatusIndicator from '@/components/ui/StatusIndicator';

// Determines if the current value is in an alarm threshold so we can show it in red rather
// than the more faded default style.
const isAlarmState = (current: number, limit: number): boolean => limit > 0 && current / (limit * 1024 * 1024) >= 0.9;

type Timer = ReturnType<typeof setInterval>;

export default ({ server }: { server: Server; }) => {
    const interval = useRef<Timer>(null) as React.MutableRefObject<Timer>;
    const [isSuspended, setIsSuspended] = useState(server.status === 'suspended');
    const [stats, setStats] = useState<ServerStats | null>(null);

    const getStats = () =>
        getServerResourceUsage(server.uuid)
            .then((data) => setStats(data))
            .catch((error) => console.error(error));

    useEffect(() => {
        setIsSuspended(stats?.isSuspended || server.status === 'suspended');
    }, [stats?.isSuspended, server.status]);

    useEffect(() => {
        // Don't waste a HTTP request if there is nothing important to show to the user because
        // the server is suspended.
        if (isSuspended) return;

        getStats().then(() => {
            interval.current = setInterval(() => getStats(), 30000);
        });

        return () => {
            interval.current && clearInterval(interval.current);
        };
    }, [isSuspended]);

    const alarms = { cpu: false, memory: false, disk: false };
    if (stats) {
        alarms.cpu = server.limits.cpu === 0 ? false : stats.cpuUsagePercent >= server.limits.cpu * 0.9;
        alarms.memory = isAlarmState(stats.memoryUsageInBytes, server.limits.memory);
        alarms.disk = server.limits.disk === 0 ? false : isAlarmState(stats.diskUsageInBytes, server.limits.disk);
    }

    const diskLimit = server.limits.disk !== 0 ? bytesToString(mbToBytes(server.limits.disk)) : 'Unlimited';
    const memoryLimit = server.limits.memory !== 0 ? bytesToString(mbToBytes(server.limits.memory)) : 'Unlimited';
    const cpuLimit = server.limits.cpu !== 0 ? server.limits.cpu + ' %' : 'Unlimited';

    // Check if server is in a other state (suspended, transferring, etc.)
    const isSpecialState = isSuspended || server.isTransferring || (server.status && !stats);

    return (
    <Link
      to={`/server/${server.id}`}
    >
      <Card className="!p-0">
        <div className="rounded-ui bg-center bg-cover bg-no-repeat bg-center relative px-6 pt-6 pb-6 z-10"
            style={{
                backgroundImage: `url(${server.eggBanner ? server.eggBanner : '/revix/default-bg.png'})`,
            }}
        >
          <div
            className={"z-[-1] absolute inset-0 rounded-ui backdrop-blur-sm"}
            css={
              "background-image: linear-gradient(0deg, rgb(var(--color-700)) 10%, color-mix(in srgb, rgb(var(--color-700)) 35%, transparent) 55%);"
            }
          />
          <div className="flex items-center justify-between pb-5">
            <Title className="text-2xl">{server.name}</Title>
            <StatusIndicator server={server} />
          </div>
          <div className={`${isSpecialState ? 'flex justify-center items-center min-h-[100px]' : 'grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4'} mt-4`}>
            {!stats || isSuspended ? (
              isSuspended ? (
                <React.Fragment>
                  <StatBlock className="bg-danger/50 backdrop-blur-sm border border-danger/80">
                    <p>
                      {server.status === "suspended"
                        ? "Suspended"
                        : "Connection Error"}
                    </p>
                  </StatBlock>
                </React.Fragment>
              ) : server.isTransferring || server.status ? (
                <React.Fragment>
                  <StatBlock className="backdrop-blur-sm bg-yellow-500/50 border border-yellow-500/70">
                    <span className="w-4 sm:w-5 text-gray-300">
                      <ChipIcon />
                    </span>
                    <p>
                      {" "}
                      {server.isTransferring
                        ? "Transferring"
                        : server.status === "installing"
                        ? "Installing"
                        : server.status === "restoring_backup"
                        ? "Restoring Backup"
                        : "Unavailable"}
                    </p>
                  </StatBlock>
                </React.Fragment>
              ) : (
                <Spinner size={"small"} />
              )
            ) : (
              <React.Fragment>
            <StatBlock className="backdrop-blur-sm bg-gray-500/20 border border-gray-500/50">
              <span className="w-4 sm:w-5 text-gray-300">
                <GlobeIcon />
              </span>
              <span
                className={`duration-300 text-xs sm:text-sm text-white/90`}
              >
                {server.allocations
                  .filter((alloc) => alloc.isDefault)
                  .map((allocation) => (
                    <React.Fragment
                      key={allocation.ip + allocation.port.toString()}
                    >
                      {allocation.alias || ip(allocation.ip)}:{allocation.port}
                    </React.Fragment>
                  ))}
              </span>
            </StatBlock>
                <StatBlock className="backdrop-blur-sm bg-gray-500/20 border border-gray-500/50">
                  <span className="w-4 sm:w-5 text-gray-300">
                    <ChipIcon />
                  </span>
                  <p className={alarms.cpu ? "text-danger-50" : ""}>
                    {stats.cpuUsagePercent.toFixed(2)}%
                  </p>
                  <span className="text-xs sm:text-sm text-gray-300">/ {cpuLimit}</span>
                </StatBlock>
                <StatBlock className="backdrop-blur-sm bg-gray-500/20 border border-gray-500/50">
                  <span className="w-4 sm:w-5 text-gray-300">
                    <FontAwesomeIcon icon={faMemory} />
                  </span>
                  <p className={alarms.memory ? "text-danger-50" : ""}>
                    {bytesToString(stats.memoryUsageInBytes)}
                  </p>
                  <span className="text-xs sm:text-sm text-gray-300">/ {memoryLimit}</span>
                </StatBlock>
                <StatBlock className="backdrop-blur-sm bg-gray-500/20 border border-gray-500/50">
                  <span className="w-4 sm:w-5 text-gray-300">
                    <SaveIcon />
                  </span>
                  <p className={alarms.disk ? "text-danger-50" : ""}>
                    {bytesToString(stats.diskUsageInBytes)}
                  </p>
                  <span className="text-xs sm:text-sm text-gray-300">/ {diskLimit}</span>
                </StatBlock>
              </React.Fragment>
            )}
          </div>
        </div>
      </Card>
    </Link>
    );
};