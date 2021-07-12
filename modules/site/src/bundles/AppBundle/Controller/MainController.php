<?php

namespace RusLan\ResolveTest\Site\AppBundle\Controller;

use RusLan\ResolveTest\Site\AppBundle\Provider\Balance\BalanceProviderAwareInterface;
use RusLan\ResolveTest\Site\AppBundle\Provider\Balance\BalanceProviderAwareTrait;
use RusLan\ResolveTest\Site\AppBundle\Provider\History\HistoryProviderAwareInterface;
use RusLan\ResolveTest\Site\AppBundle\Provider\History\HistoryProviderAwareTrait;
use RusLan\ResolveTest\Site\AppBundle\Provider\User\UserProviderAwareInterface;
use RusLan\ResolveTest\Site\AppBundle\Provider\User\UserProviderAwareTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController implements
    UserProviderAwareInterface,
    BalanceProviderAwareInterface,
    HistoryProviderAwareInterface
{
    use UserProviderAwareTrait;
    use BalanceProviderAwareTrait;
    use HistoryProviderAwareTrait;

    public function index(Request $request, int $userId, int $limit): Response
    {
        return $this->render('@AppBundle/page/main.html.twig', [
            'limit' => $limit,
            'user' => $user = $this->getUserProvider()->find($userId),
            'balance' => $this->getBalanceProvider()->get($user),
            'history' => $this->getHistoryProvider()->get($user, $limit),
        ]);
    }
}
