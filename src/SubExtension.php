<?php

/*
 * This file is part of the ows/commonmark-sup-sub-extensions package.
 */

namespace Ows\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ExtensionInterface;

/**
 * @deprecated in 3.0.0, will be removed in 4.0.0. Use \Ows\CommonMark\SupSubExtension\SubExtension instead.
 */
final class SubExtension implements ExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(EnvironmentBuilderInterface $environment): void
    {
        @trigger_error(__CLASS__ . ' is deprecated in 3.0.0, use ' . SupSubExtension\SubExtension::class . ' instead.', E_USER_DEPRECATED);
        (new SupSubExtension\SubExtension())->register($environment);
    }
}
