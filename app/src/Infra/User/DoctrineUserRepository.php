<?php declare(strict_types=1);

namespace App\Infra\User;

use App\Domain\User\Exception\UnableToDeleteUserException;
use App\Domain\User\Exception\UnableToSaveUserException;
use App\Domain\User\User;
use App\Domain\User\UserCreator as Creator;
use App\Domain\User\UserDeleter as Delete;
use App\Domain\User\UserFinder as Finder;
use App\Domain\User\UserUpdater as Update;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Throwable;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineUserRepository extends ServiceEntityRepository implements Finder, Creator, Update, Delete
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findById(string $id): ?User
    {
        return $this->find($id);
    }

    /**
     * @throws UnableToSaveUserException
     */
    public function create(User $user): void
    {
        try {
            $em = $this->getEntityManager();
            $em->persist($user);
            $em->flush();
        } catch (Throwable $e) {
            throw new UnableToSaveUserException($e);
        }
    }

    /**
     * @throws UnableToSaveUserException
     */
    public function update(User $user): void
    {
        try {
            $em = $this->getEntityManager();
            $em->merge($user);
            $em->flush();
        } catch (Throwable $e) {
            throw new UnableToSaveUserException($e);
        }
    }

    /**
     * @throws UnableToDeleteUserException
     */
    public function delete(User $user): void
    {
        try {
            $em = $this->getEntityManager();
            $em->remove($user);
            $em->flush();
        } catch (Throwable $e) {
            throw new UnableToDeleteUserException($e);
        }
    }
}
