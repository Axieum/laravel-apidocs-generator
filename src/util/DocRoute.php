<?php

namespace Axieum\ApiDocs\util;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\DocBlock;

class DocRoute
{
    /** @var Route $route */
    protected $route;

    /** @var Collection<DocBlock> $docblocks all extracted docblock(s) */
    public $docblocks;

    /** @var array<mixed> $meta documentation metadata */
    public $meta = [];

    /**
     * Constructs a new Documented Route.
     *
     * @param Route $route underlying route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
        $this->docblocks = new Collection();
    }

    /**
     * Returns the underlying route.
     *
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    /**
     * Returns a named docblock or null if not specified.
     *
     * @param string $key docblock name
     * @return DocBlock|null named docblock or null if not set
     */
    public function getDocBlock(string $key): ?DocBlock
    {
        return $this->docblocks->get($key);
    }

    /**
     * Adds a new docblock to the route.
     *
     * @param string        $key      docblock name
     * @param DocBlock|null $docblock extracted docblock
     * @return $this
     */
    public function addDocBlock(string $key, ?DocBlock $docblock = null): self
    {
        $this->docblocks->put($key, $docblock);
        return $this;
    }

    /**
     * Determines whether the route has a named docblock.
     *
     * @param string $key docblock name
     * @return bool true if the docblock exists
     */
    public function hasDocBlock(string $key): bool
    {
        return !is_null($this->docblocks->get($key));
    }

    /**
     * Returns the metadata value associated with a given name, or null if not
     * set.
     *
     * @param string     $key     metadata name
     * @param mixed|null $default fallback metadata value if non-existent
     * @return mixed|null metadata value or default if specified
     */
    public function getMeta(string $key, $default = null)
    {
        return $this->meta[$key] ?? $default;
    }

    /**
     * Sets a given metadata property on the route.
     *
     * @param string     $key   metadata name
     * @param mixed|null $value metadata value
     * @return $this
     */
    public function setMeta(string $key, $value = null): self
    {
        $this->meta[$key] = $value;
        return $this;
    }

    /**
     * Determines whether the route has a metadata.
     *
     * @param string $key metadata name
     * @return bool true if the metadata exists
     */
    public function hasMeta(string $key): bool
    {
        return isset($this->meta[$key]);
    }

    /**
     * Returns the underlying route's uri.
     *
     * @return string route uri
     */
    public function uri(): string
    {
        return $this->route->uri();
    }

    /**
     * Returns the underlying route's methods, except {@see Request::METHOD_HEAD}.
     *
     * @return array<string> methods
     */
    public function methods(): array
    {
        return array_diff($this->route->methods(), [Request::METHOD_HEAD]);
    }
}