<?php
/**
 * Created by PhpStorm.
 * User: kuben
 * Date: 07/03/2019
 * Time: 14:52
 */

namespace App\Serializer;


use ApiPlatform\Core\Exception\RuntimeException;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UsersContextBuilder implements SerializerContextBuilderInterface
{
    private $decorated;
    private $authorizationChecker;

    /**
     * UsersContextBuilder constructor.
     * @param $decorated
     * @param $authorization_checker
     */
    public function __construct(SerializerContextBuilderInterface $decorated, AuthorizationCheckerInterface $authorization_checker)
    {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorization_checker;
    }


    /**
     * Creates a serialization context from a Request.
     *
     * @throws RuntimeException
     */
    public function createFromRequest(Request $request, bool $normalization, ?array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);
        //$resourceClass = $context['resource_class'] ?? null;

        if (isset($context['groups']) && $this->authorizationChecker->isGranted('ROLE_USER') && false === $normalization) {
            $context['groups'][] = 'user:input';
        }

        return $context;
    }
}