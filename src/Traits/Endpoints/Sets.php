<?php
namespace Avido\LaravelBricksetApiClient\Traits\Endpoints;

/**
 * Trait Sets
 * @package Avido\LaravelBricksetApiClient\Traits
 *
 * Sets related methods
 */
trait Sets
{
    /**
     * Get Sets
     * Retrieve a list of sets, or more information about a particular one.
     * Params: (Note: Parameters marked with a * will accept a Decimal value or a comma delimited list.)
     *  - setID         # Internal SetID
     *  - query         # Search term: searches set number, name, theme and subtheme
     *  - theme *       # Theme
     *  - subtheme *    # Subtheme
     *  - setNumber *   # Full set number, in the format {number}-{variant}, e.g. 6876-1
     *  - year *        # year
     * - tag            # tag
     * - owned          # Set to 1 to retrieve a user's owned sets
     * - wanted         # Set to 1 to retrieve a user's wanted sets
     * - updatedSince   # yyyy-mm-dd format
     * - orderBy        # Sort order
     *                      Valid values: are Number, YearFrom, Pieces, Minifigs, Rating,
     *                      [UK|US|CA|DE|FRRetailPrice], [UK|US|CA|DE|FRPricePerPiece], Theme, Subtheme, Name, Random,
     *                      QtyOwned, OwnCount, WantCount, UserRating,
     *                      CollectionID (order record added to a user's collection)
     *                      Add 'DESC' to the end of numerical field names to sort descending, e.g. PiecesDESC.
     *                      Default: Number. Values are case-insensitive.
     * - pageSize       # Specify how many records to retrieve (default: 20, max: 500)
     * - pageNumber     # Specify which page of records to retrieve, use in conjunction with pageSize (default: 1)
     * - extendedData   # Set to 1 to retrieve the full data set, including tags, description and notes.
     * @return \stdClass
     */
    public function getSets(array $params = []): \stdClass
    {
        if (count($params) === 0) {
            throw new \InvalidArgumentException("At least one parameter is required");
        }
        return $this->post('getSets', [
            'userHash' => $this->getUserHash(),
            'params' => json_encode($params)
        ]);
    }

    /**
     * Get Additional Images
     * Get a list of URLs of additional set images for the specified set.
     *
     * @param string $setId
     * @return \stdClass
     */
    public function getAdditionalImages(string $setId): \stdClass
    {
        return $this->post('getAdditionalImages', [
            'setID' => $setId
        ]);
    }

    /**
     * Get Instructions
     * Get a list of instructions for the specified set.
     *
     * @param string $setId
     * @return \stdClass
     */
    public function getInstructions(string $setId): \stdClass
    {
        return $this->post('getInstructions', [
            'setID' => $setId
        ]);
    }

    /**
     * Get Themes
     * Get a list of themes, with the total number of sets in each.
     *
     * @return \stdClass
     */
    public function getThemes(): \stdClass
    {
        return $this->post('getThemes');
    }

    /**
     * Get Subthemes
     * Get a list of subthemes for a given theme, with the total number of sets in each.
     *
     * @param string $theme
     * @return \stdClass
     */
    public function getSubthemes(string $theme): \stdClass
    {
        return $this->post('getSubthemes', [
            'theme' => $theme
        ]);
    }

    /**
     * Get Years
     * Get a list of years for a given theme, with the total number of sets in each.
     *
     * @param string $theme
     * @return \stdClass
     */
    public function getYears(?string $theme = ''): \stdClass
    {
        return $this->post('getYears', [
            'theme' => $theme
        ]);
    }

    /**
     * Set Collection
     * Set a user's collection details.
     * Params:
     *  - own           # 1 or 0. If 0 then qtyOwned is automatically set to 0
     *  - want          # 1 or 0
     *  - qtyOwned      # 0-999. If > 0 then own is automatically set to 1
     *  - notes         # User notes, max 200 characters
     *  - rating        # User rating 1-5
     * @param string $setId
     * @param array $parameters
     * @return \stdClass
     * @throws InvalidParameterException
     */
    public function setCollection(string $setId, array $parameters): \stdClass
    {
        // validate parameters
        $this->validateParameters($parameters, $this->setCollectionParameterAvailable);
        return $this->post('setCollection', [
            'setID' => $setId,
            'userHash' => $this->getUserHash(),
            'params' => json_encode($parameters)
        ]);
    }

    /**
     * Get User Notes
     * Get all of a user's set notes.
     *
     * @return \stdClass
     */
    public function getUserNotes(): \stdClass
    {
        return $this->post('getUserNotes', [
            'userHash' => $this->getUserHash()
        ]);
    }
}
