<?php
declare(strict_types = 1);

namespace App\DTO;

use Swagger\Annotations as SWG;

/**
 * Channel Event
 *
 * @SWG\Definition(definition="ChannelEvent", description="Channel Event",
 *                                            type="object",required={"eventID","channelId","channelStbNumber"})
 */
class ChannelEvent
{
    /**
     * @var array
     */
    public static $validation = [
        'eventID'            => 'bail|required|string',
        'channelId'          => 'bail|required|integer',
        'channelStbNumber'   => 'bail|required|integer',
        'channelHD'          => 'bail|boolean',
        'channelTitle'       => 'bail|string',
        'epgEventImage'      => 'bail|string',
        'certification'      => 'bail|integer',
        'displayDateTimeUtc' => 'bail|date',
        'displayDateTime'    => 'bail|date',
        'displayDuration'    => 'bail|date',
        'siTrafficKey'       => 'bail|string',
        'programmeTitle'     => 'bail|string',
        'programmeId'        => 'bail|integer',
        'episodeId'          => 'bail|string',
        'shortSynopsis'      => 'bail|string',
        'longSynopsis'       => 'bail|string',
        'actors'             => 'bail|string',
        'directors'          => 'bail|string',
        'producers'          => 'bail|string',
        'genre'              => 'bail|string',
        'subGenre'           => 'bail|string',
        'live'               => 'bail|boolean',
        'premier'            => 'bail|boolean',
        'ottBlackout'        => 'bail|boolean',
        'highlight'          => 'bail|boolean',
        'contentId'          => 'bail|string',
        'contentImage'       => 'bail|string',
        'groupKey'           => 'bail|string',
    ];

    /**
     * @var string
     */
    protected $provider;

    /**
     * actors
     *
     * @SWG\Property(description="actors", type="string")
     * @var string|null
     */
    protected $actors;

    /**
     * certification
     *
     * @SWG\Property(description="certification", type="integer")
     * @var integer|null
     */
    protected $certification;

    /**
     * channelHD
     *
     * @SWG\Property(description="channelHD", type="boolean")
     * @var boolean|null
     */
    protected $channelHD;

    /**
     * channelId
     *
     * @SWG\Property(description="channelId", type="integer")
     * @var integer
     */
    protected $channelId;

    /**
     * channelStbNumber
     *
     * @SWG\Property(description="channelStbNumber", type="integer")
     * @var integer
     */
    protected $channelStbNumber;

    /**
     * channelTitle
     *
     * @SWG\Property(description="channelTitle", type="string")
     * @var string|null
     */
    protected $channelTitle;

    /**
     * contentId
     *
     * @SWG\Property(description="contentId", type="string")
     * @var string|null
     */
    protected $contentId;

    /**
     * contentImage
     *
     * @SWG\Property(description="contentImage", type="string")
     * @var string|null
     */
    protected $contentImage;

    /**
     * directors
     *
     * @SWG\Property(description="directors", type="string")
     * @var string|null
     */
    protected $directors;

    /**
     * displayDateTime
     *
     * @SWG\Property(description="displayDateTime", type="string")
     * @var string|null
     */
    protected $displayDateTime;

    /**
     * displayDateTimeUtc
     *
     * @SWG\Property(description="displayDateTimeUtc", type="string")
     * @var string|null
     */
    protected $displayDateTimeUtc;

    /**
     * displayDuration
     *
     * @SWG\Property(description="displayDuration", type="string")
     * @var string|null
     */
    protected $displayDuration;

    /**
     * epgEventImage
     *
     * @SWG\Property(description="epgEventImage", type="string")
     * @var string|null
     */
    protected $epgEventImage;

    /**
     * episodeId
     *
     * @SWG\Property(description="episodeId", type="string")
     * @var string|null
     */
    protected $episodeId;

    /**
     * eventID
     *
     * @SWG\Property(description="eventID", type="string")
     * @var int
     */
    protected $eventID;

    /**
     * genre
     *
     * @SWG\Property(description="genre", type="string")
     * @var string|null
     */
    protected $genre;

    /**
     * groupKey
     *
     * @SWG\Property(description="groupKey", type="string")
     * @var string|null
     */
    protected $groupKey;

    /**
     * highlight
     *
     * @SWG\Property(description="highlight", type="boolean")
     * @var boolean|null
     */
    protected $highlight;

    /**
     * live
     *
     * @SWG\Property(description="live", type="boolean")
     * @var boolean|null
     */
    protected $live;

    /**
     * longSynopsis
     *
     * @SWG\Property(description="longSynopsis", type="string")
     * @var string|null
     */
    protected $longSynopsis;

    /**
     * ottBlackout
     *
     * @SWG\Property(description="ottBlackout", type="boolean")
     * @var boolean|null
     */
    protected $ottBlackout;

    /**
     * premier
     *
     * @SWG\Property(description="premier", type="boolean")
     * @var boolean|null
     */
    protected $premier;

    /**
     * producers
     *
     * @SWG\Property(description="producers", type="string")
     * @var string|null
     */
    protected $producers;

    /**
     * programmeId
     *
     * @SWG\Property(description="programmeId", type="integer")
     * @var integer|null
     */
    protected $programmeId;

    /**
     * programmeTitle
     *
     * @SWG\Property(description="programmeTitle", type="string")
     * @var string|null
     */
    protected $programmeTitle;

    /**
     * shortSynopsis
     *
     * @SWG\Property(description="shortSynopsis", type="string")
     * @var string|null
     */
    protected $shortSynopsis;

    /**
     * siTrafficKey
     *
     * @SWG\Property(description="siTrafficKey", type="string")
     * @var string|null
     */
    protected $siTrafficKey;

    /**
     * subGenre
     *
     * @SWG\Property(description="subGenre", type="string")
     * @var string|null
     */
    protected $subGenre;

    /**
     * ChannelEvent constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set'.ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * @return null|string
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param null|string $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
    }

    /**
     * @return int|null
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param int|null $certification
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    }

    /**
     * @return bool|null
     */
    public function getChannelHD()
    {
        return $this->channelHD;
    }

    /**
     * @param bool|null $channelHD
     */
    public function setChannelHD($channelHD)
    {
        $this->channelHD = (boolean) $channelHD;
    }

    /**
     * @return int
     */
    public function getChannelId(): int
    {
        return $this->channelId;
    }

    /**
     * @param int $channelId
     */
    public function setChannelId(int $channelId)
    {
        $this->channelId = $channelId;
    }

    /**
     * @return int
     */
    public function getChannelStbNumber(): int
    {
        return $this->channelStbNumber;
    }

    /**
     * @param int $channelStbNumber
     */
    public function setChannelStbNumber($channelStbNumber)
    {
        $this->channelStbNumber = (int) $channelStbNumber;
    }

    /**
     * @return null|string
     */
    public function getChannelTitle()
    {
        return $this->channelTitle;
    }

    /**
     * @param null|string $channelTitle
     */
    public function setChannelTitle($channelTitle)
    {
        $this->channelTitle = $channelTitle;
    }

    /**
     * @return null|string
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * @param null|string $contentId
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
    }

    /**
     * @return null|string
     */
    public function getContentImage()
    {
        return $this->contentImage;
    }

    /**
     * @param null|string $contentImage
     */
    public function setContentImage($contentImage)
    {
        $this->contentImage = $contentImage;
    }

    /**
     * @return null|string
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param null|string $directors
     */
    public function setDirectors($directors)
    {
        $this->directors = $directors;
    }

    /**
     * @return null|string
     */
    public function getDisplayDateTime()
    {
        return $this->displayDateTime;
    }

    /**
     * @param null|string $displayDateTime
     */
    public function setDisplayDateTime($displayDateTime)
    {
        $this->displayDateTime = $displayDateTime;
    }

    /**
     * @return null|string
     */
    public function getDisplayDateTimeUtc()
    {
        return $this->displayDateTimeUtc;
    }

    /**
     * @param null|string $displayDateTimeUtc
     */
    public function setDisplayDateTimeUtc($displayDateTimeUtc)
    {
        $this->displayDateTimeUtc = $displayDateTimeUtc;
    }

    /**
     * @return null|string
     */
    public function getDisplayDuration()
    {
        return $this->displayDuration;
    }

    /**
     * @param null|string $displayDuration
     */
    public function setDisplayDuration($displayDuration)
    {
        $this->displayDuration = $displayDuration;
    }

    /**
     * @return null|string
     */
    public function getEpgEventImage()
    {
        return $this->epgEventImage;
    }

    /**
     * @param null|string $epgEventImage
     */
    public function setEpgEventImage($epgEventImage)
    {
        $this->epgEventImage = $epgEventImage;
    }

    /**
     * @return null|string
     */
    public function getEpisodeId()
    {
        return $this->episodeId;
    }

    /**
     * @param null|string $episodeId
     */
    public function setEpisodeId($episodeId)
    {
        $this->episodeId = $episodeId;
    }

    /**
     * @return int
     */
    public function getEventID(): int
    {
        return $this->eventID;
    }

    /**
     * @param int $eventID
     */
    public function setEventID($eventID)
    {
        $this->eventID = $eventID;
    }

    /**
     * @return null|string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param null|string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return null|string
     */
    public function getGroupKey()
    {
        return $this->groupKey;
    }

    /**
     * @param null|string $groupKey
     */
    public function setGroupKey($groupKey)
    {
        $this->groupKey = $groupKey;
    }

    /**
     * @return bool|null
     */
    public function getHighlight()
    {
        return $this->highlight;
    }

    /**
     * @param bool|null $highlight
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;
    }

    /**
     * @return bool|null
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * @param bool|null $live
     */
    public function setLive($live)
    {
        $this->live = $live;
    }

    /**
     * @return null|string
     */
    public function getLongSynopsis()
    {
        return $this->longSynopsis;
    }

    /**
     * @param null|string $longSynopsis
     */
    public function setLongSynopsis($longSynopsis)
    {
        $this->longSynopsis = $longSynopsis;
    }

    /**
     * @return bool|null
     */
    public function getOttBlackout()
    {
        return $this->ottBlackout;
    }

    /**
     * @param bool|null $ottBlackout
     */
    public function setOttBlackout($ottBlackout)
    {
        $this->ottBlackout = $ottBlackout;
    }

    /**
     * @return bool|null
     */
    public function getPremier()
    {
        return $this->premier;
    }

    /**
     * @param bool|null $premier
     */
    public function setPremier($premier)
    {
        $this->premier = $premier;
    }

    /**
     * @return null|string
     */
    public function getProducers()
    {
        return $this->producers;
    }

    /**
     * @param null|string $producers
     */
    public function setProducers($producers)
    {
        $this->producers = $producers;
    }

    /**
     * @return int|null
     */
    public function getProgrammeId()
    {
        return $this->programmeId;
    }

    /**
     * @param int|null $programmeId
     */
    public function setProgrammeId($programmeId)
    {
        $this->programmeId = $programmeId;
    }

    /**
     * @return null|string
     */
    public function getProgrammeTitle()
    {
        return $this->programmeTitle;
    }

    /**
     * @param null|string $programmeTitle
     */
    public function setProgrammeTitle($programmeTitle)
    {
        $this->programmeTitle = $programmeTitle;
    }

    /**
     * @return null|string
     */
    public function getShortSynopsis()
    {
        return $this->shortSynopsis;
    }

    /**
     * @param null|string $shortSynopsis
     */
    public function setShortSynopsis($shortSynopsis)
    {
        $this->shortSynopsis = $shortSynopsis;
    }

    /**
     * @return null|string
     */
    public function getSiTrafficKey()
    {
        return $this->siTrafficKey;
    }

    /**
     * @param null|string $siTrafficKey
     */
    public function setSiTrafficKey($siTrafficKey)
    {
        $this->siTrafficKey = $siTrafficKey;
    }

    /**
     * @return null|string
     */
    public function getSubGenre()
    {
        return $this->subGenre;
    }

    /**
     * @param null|string $subGenre
     */
    public function setSubGenre($subGenre)
    {
        $this->subGenre = $subGenre;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return ChannelEvent
     */
    public function setProvider(string $provider): ChannelEvent
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return get_object_vars($this);
    }
}
