<?php

namespace App\Http\Controllers;

use Hateoas\Configuration\Exclusion;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Hateoas\HateoasBuilder;
use Hateoas\UrlGenerator\CallableUrlGenerator;
use Illuminate\Pagination\LengthAwarePaginator;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;

class Controller extends BaseController
{
	/**
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * @param $data
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function hateoasResponse($data) {
		if(get_class($data) == 'Illuminate\Pagination\LengthAwarePaginator')
			$data = $this->formateHatoeasPaged($data);
		
		$hateoas = HateoasBuilder::create()->setUrlGenerator(
			null,
			new CallableUrlGenerator(function ($route, array $parameters, $absolute) {
				$fullUrl = route($route, $parameters);
				return $absolute ? $fullUrl : str_replace(url(), '', $fullUrl);
			})
		)->build();
		
		$json = $hateoas->serialize($data, 'json');
		
		// todo: insert correct status code based on action (ie 206 partial, 201 created etc)
		return response($json, 200)->header('Content-Type', 'application/json');
    }

	/**
	 * @param LengthAwarePaginator $paged
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function hateoasPagedResponse( LengthAwarePaginator $paged ) {
		$paginatedCollection = $this->formateHatoeasPaged($paged);
		return $this->hateoasResponse($paginatedCollection);
	}

	/**
	 * @param LengthAwarePaginator $paged
	 *
	 * @return PaginatedRepresentation
	 */
	public function formateHatoeasPaged( LengthAwarePaginator $paged ) {
		$request = \App::make('request');
		$params = array_merge($request->route()[2], $request->all());

		return new PaginatedRepresentation(
			new CollectionRepresentation(
				$paged->getCollection(),
				null,
				$request->path()
			),
			$request->route()[1]['as'], // route
			$params, // route parameters
			$paged->currentPage(), // page number
			$paged->perPage(), // limit
			$paged->lastPage(), // total pages
			'page', // page route parameter name, optional, defaults to 'page'
			'per_page', // limit route parameter name, optional, defaults to 'limit'
			true, // generate relative URIs, optional, defaults to `false`
			$paged->total() // total collection size, optional, defaults to `null`
		);
	}
}
