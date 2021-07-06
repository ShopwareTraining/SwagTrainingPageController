<?php declare(strict_types=1);

namespace SwagTraining\PageController\Storefront\Controller;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\Framework\Routing\Annotation\Since;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 */
class ExamplePageController extends StorefrontController
{
    private SystemConfigService $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    /**
     * @Since("6.4.0.0")
     * @Route("/swag-training/page-controller", name="frontend.swag-training.page-controller", methods={"GET"},
     *                       defaults={"XmlHttpRequest"=true})
     */
    public function getData(Request $request, Context $context): Response
    {
        $greetingName = $this->systemConfigService->get('SwagTrainingPageController.config.greetingName');

        return $this->renderStorefront(
            '@SwagTrainingPageController/storefront/page/content/helloworld.html.twig',
            ['greetingName' => $greetingName]
        );
    }
}
