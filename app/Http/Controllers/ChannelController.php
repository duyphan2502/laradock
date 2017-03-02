<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Astro\Client;
use App\Model\FavouriteModel;
use App\Repository\FavouriteRepository;
use App\Services\BroadcastingProvider;
use App\Transformer\ChannelArrayTransformer;
use App\Transformer\ChannelEventTransformer;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    use Helpers;

    /**
     * @return Response
     * @throws \RuntimeException
     * @SWG\Put(
     *     tags={"Channel"},
     *     path="/api/channels",
     *     summary="Channel",
     *     description="Receive Channel platform",
     *     @SWG\Response(
     *         response="200",
     *         description="Accepted",
     *          @SWG\Schema(ref="#/definitions/ChannelResponses"),
     *     ),
     *      @SWG\Response(
     *          response="422",
     *          description="422 Unprocessable Entity",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *     )
     * )
     */
    public function channels()
    {
        /**
         * @var $provider BroadcastingProvider
         */
        $provider = app(BroadcastingProvider::class);
        $channels = $provider->getChannelsFrom(Client::ASTRO_SERVICE);

        return $this->response->collection($channels, app(ChannelArrayTransformer::class));
    }

    /**
     * @param $provider
     * @param $id
     *
     * @return mixed
     */
    public function channel($provider, $id)
    {
        /**
         * @var $broadcastProvider BroadcastingProvider
         */
        $broadcastProvider = app(BroadcastingProvider::class);
        $events            = $broadcastProvider->getChannelEvents(
            (int) $id,
            $provider ?? Client::ASTRO_SERVICE
        );

        return $this->response->collection($events, app(ChannelEventTransformer::class));
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @SWG\Post(
     *     tags={"Channel"},
     *     path="/api/channel/{id}",
     *     summary="Channel",
     *     description="Stick Favourite Channel",
     *     @SWG\Parameter(
     *         description="Stick as Favourite Channel",
     *         in="body",
     *         name="content",
     *         @SWG\Schema(ref="#/definitions/ChannelRequest")
     *     ),
     *     @SWG\Response(
     *         response="202",
     *         description="Accepted"
     *     ),
     *      @SWG\Response(
     *          response="422",
     *          description="422 Unprocessable Entity",
     *          @SWG\Schema(ref="#/definitions/ErrorResponse"),
     *     )
     * )
     * @SWG\Definition(
     *      definition="ChannelRequest",
     *      @SWG\Property(property="channel", type="integer"),
     *      @SWG\Property(property="token", type="string", description="Current User token"),
     *      required={"channel","token"}
     *     )
     */
    public function favourite(Request $request)
    {
        $this->validate($request, FavouriteModel::$validation);
        /**
         * @var $repo FavouriteRepository
         */
        $repo = app(FavouriteRepository::class);
        try {
            $repo->saveHistory($request->input('token'), (int) $request->input('channel'));
        } catch (\Exception $e) {
            return $this->response->errorBadRequest('Already set as favourite');
        }

        return $this->response->accepted();
    }
}
