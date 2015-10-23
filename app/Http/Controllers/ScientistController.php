<?php

namespace App\Http\Controllers;

use App\Repositories\TheoryRepository;
use Illuminate\Http\Request;
use App\Repositories\ScientistRepository;

class ScientistController extends Controller {
	protected $repository;

	public function __construct( ScientistRepository $repository, TheoryRepository $theories ) {
		$this->repository = $repository;
		$this->theories   = $theories;
	}

	public function index( Request $request ) {
		$scientists = $this->repository->paginateAll( $request->get( 'per_page', 15 ) );

		return $this->hateoasResponse( $scientists );
	}

	public function show( $id ) {
		$scientists = $this->repository->find( $id );

		return $this->hateoasResponse( $scientists );
	}

	public function store() {
		$scientist = $this->repository->createFake();

		return $this->hateoasResponse( $scientist );
	}

	public function theories( Request $request, $scientist_id ) {
		$theories = $this->theories->findByScientistId( $scientist_id, $request->get( 'per_page' ) );

		return $this->hateoasResponse( $theories );
	}

}