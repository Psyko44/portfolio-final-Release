<?php

namespace App\Test\Controller;

use App\Entity\ContactMessages;
use App\Repository\ContactMessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactMessagesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ContactMessagesRepository $repository;
    private string $path = '/message/admin/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(ContactMessages::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ContactMessage index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'contact_message[name]' => 'Testing',
            'contact_message[email]' => 'Testing',
            'contact_message[message]' => 'Testing',
            'contact_message[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/message/admin/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ContactMessages();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setMessage('My Title');
        $fixture->setCreated_at('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ContactMessage');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ContactMessages();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setMessage('My Title');
        $fixture->setCreated_at('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'contact_message[name]' => 'Something New',
            'contact_message[email]' => 'Something New',
            'contact_message[message]' => 'Something New',
            'contact_message[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/message/admin/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getMessage());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ContactMessages();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setMessage('My Title');
        $fixture->setCreated_at('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/message/admin/');
    }
}
