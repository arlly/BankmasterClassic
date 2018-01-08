<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\ParameterBag;

trait UrlParameterTrait
{

    public function generateUrlParameter(ParameterBag $query)
    {
        $parameter = '';
        $no = 0;

        foreach ($query as $k => $v) {
            if ($k === 'page')
                continue;

            $parameter .= "{$k}={$v}";
            $no ++;

            if ($no !== count($query))
                $parameter .= "&";
        }
        return $parameter;
    }
}
