<?php
declare(strict_types = 1);

namespace App\Model;

/**
 * Class ChannelEventModel
 *
 * @package App\Model
 */
class ChannelEventModel extends AbstractCacheableModel
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'channel_events';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'provider',
        'eventID',
        'channelId',
        'channelStbNumber',
        'channelHD',
        'channelTitle',
        'epgEventImage',
        'certification',
        'displayDateTimeUtc',
        'displayDateTime',
        'displayDuration',
        'siTrafficKey',
        'programmeTitle',
        'programmeId',
        'episodeId',
        'shortSynopsis',
        'longSynopsis',
        'actors',
        'genre',
        'subGenre',
    ];

    /**
     *
     * @param array $data
     *
     * @return ChannelModel
     */
    public function init(array $data)
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->setAttribute($key, $value);
            }
        }

        return $this;
    }
}
