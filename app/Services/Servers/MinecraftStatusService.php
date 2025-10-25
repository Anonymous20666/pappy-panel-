<?php

namespace Pterodactyl\Services\Servers;

class MinecraftStatusService
{
    /**
     * Performs a Minecraft Server List Ping (TCP) to retrieve players online/max.
     * Returns [online, max] on success, or null on failure.
     */
    public function getPlayersCount(string $host, int $port, float $timeoutSeconds = 1.0): ?array
    {
        $errno = 0;
        $errstr = '';

        $fp = @fsockopen($host, $port, $errno, $errstr, $timeoutSeconds);
        if (!$fp) {
            return null;
        }

        $sec = (int) floor($timeoutSeconds);
        $usec = (int) max(0, ($timeoutSeconds - $sec) * 1000000);
        stream_set_timeout($fp, $sec, $usec);

        // Handshake packet
        $protocolVersion = 47; // broadly accepted for status
        $data = $this->writeVarInt(0x00)                                 // packet id
            . $this->writeVarInt($protocolVersion)                        // protocol version
            . $this->writeString($host)                                   // server address
            . pack('n', $port)                                            // server port (unsigned short, big-endian)
            . $this->writeVarInt(0x01);                                   // next state: status

        $packet = $this->writeVarInt(strlen($data)) . $data;
        if (@fwrite($fp, $packet) === false) {
            fclose($fp);
            return null;
        }

        // Status request packet (0x00)
        $request = $this->writeVarInt(1) . $this->writeVarInt(0x00);
        if (@fwrite($fp, $request) === false) {
            fclose($fp);
            return null;
        }

        // Read response length
        $packetLength = $this->readVarIntFromStream($fp);
        if ($packetLength === null || $packetLength <= 0) {
            fclose($fp);
            return null;
        }

        $response = $this->readExact($fp, $packetLength);
        fclose($fp);

        if ($response === null) {
            return null;
        }

        // Parse response: [packetId][string json]
        [$packetId, $offset] = $this->readVarIntFromBuffer($response, 0);
        if ($packetId === null) {
            return null;
        }

        [$jsonLength, $offset] = $this->readVarIntFromBuffer($response, $offset);
        if ($jsonLength === null) {
            return null;
        }

        $json = substr($response, $offset, $jsonLength);
        if ($json === false || strlen($json) !== $jsonLength) {
            return null;
        }

        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            return null;
        }

        $online = $decoded['players']['online'] ?? null;
        $max = $decoded['players']['max'] ?? null;

        if (!is_int($online) || !is_int($max)) {
            return null;
        }

        return [$online, $max];
    }

    private function writeString(string $value): string
    {
        return $this->writeVarInt(strlen($value)) . $value;
    }

    private function writeVarInt(int $value): string
    {
        $out = '';
        while (true) {
            if (($value & ~0x7F) === 0) {
                $out .= chr($value);
                break;
            }
            $out .= chr(($value & 0x7F) | 0x80);
            // Use PHP's right shift on ints; ensure non-negative progression
            $value = ($value >> 7) & 0x01FFFFFF; // mask to avoid sign extension concerns
        }
        return $out;
    }

    private function readVarIntFromStream($fp): ?int
    {
        $numRead = 0;
        $result = 0;
        while (true) {
            $byte = @fread($fp, 1);
            if ($byte === false || $byte === '') {
                return null;
            }
            $value = ord($byte);
            $result |= ($value & 0x7F) << (7 * $numRead);
            $numRead++;
            if ($numRead > 5) {
                return null;
            }
            if (($value & 0x80) !== 0x80) {
                break;
            }
        }
        return $result;
    }

    private function readVarIntFromBuffer(string $buffer, int $offset): array
    {
        $numRead = 0;
        $result = 0;
        $length = strlen($buffer);
        while ($offset < $length) {
            $value = ord($buffer[$offset]);
            $result |= ($value & 0x7F) << (7 * $numRead);
            $numRead++;
            $offset++;
            if ($numRead > 5) {
                return [null, $offset];
            }
            if (($value & 0x80) !== 0x80) {
                break;
            }
        }
        return [$result, $offset];
    }

    private function readExact($fp, int $length): ?string
    {
        $data = '';
        while (strlen($data) < $length) {
            $chunk = @fread($fp, $length - strlen($data));
            if ($chunk === false || $chunk === '') {
                return null;
            }
            $data .= $chunk;
        }
        return $data;
    }
}

